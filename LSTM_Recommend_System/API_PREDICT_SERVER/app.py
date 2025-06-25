from flask import Flask, request, jsonify
import numpy as np
import tensorflow as tf
from keras.models import load_model
from sklearn.preprocessing import LabelEncoder
import pandas as pd
import joblib
import os

app = Flask(__name__)

# Load model và các thành phần cần thiết
model = None
label_encoder = None
max_len = 30

def load_artifacts():
    global model, label_encoder
    
    # Load model
    model_path = '../model/5_30/session_recommendation_model.keras'

    if os.path.exists(model_path):
        model = load_model(model_path)
    else:
        raise FileNotFoundError(f"Model file not found at {os.path.exists(model_path)}")
    

# Route để kiểm tra server
@app.route('/')
def home():
    return "Session Recommendation API is running!"

# Route để nhận dự đoán
@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.json
        
        if not data or 'session_items' not in data:
            return jsonify({'error': 'Invalid input format'}), 400
        
        session_items = data['session_items']
        
        # Đảm bảo session_items là list
        if not isinstance(session_items, list):
            return jsonify({'error': 'session_items must be a list'}), 400
        
        # Tạo sequence (sửa ở đây)
        sequence = session_items[-max_len:] if len(session_items) >= max_len else session_items
        
        # Padding sequence
        if len(sequence) < max_len:
            sequence = [0] * (max_len - len(sequence)) + sequence
        
        # Reshape
        sequence = np.array([sequence])
        
        
        # Dự đoán
        predictions = model.predict(sequence, verbose=0)
        
        # Lấy top K recommendations
        top_k = 10
        top_k_indices = np.argsort(-predictions, axis=1)[0]
        filtered_indices = [int(i) for i in top_k_indices if i < 100][:top_k]
        print(filtered_indices)
        # Trả về kết quả
        return jsonify({
            'recommendations': filtered_indices,
        }), 200
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500
@app.route('/predict_app', methods=['POST'])
def predict_app():
    try:
        data = request.json
        
        if not data or 'session_items' not in data:
            return jsonify({'error': 'Invalid input format'}), 400
        
        session_items = data['session_items']
        
        # Đảm bảo session_items là list
        if not isinstance(session_items, list):
            return jsonify({'error': 'session_items must be a list'}), 400
        
        # Tạo sequence (sửa ở đây)
        sequence = session_items[-max_len:] if len(session_items) >= max_len else session_items
        
        # Padding sequence
        if len(sequence) < max_len:
            sequence = [0] * (max_len - len(sequence)) + sequence
        
        # Reshape
        sequence = np.array([sequence])
        
        
        # Dự đoán
        predictions = model.predict(sequence, verbose=0)
        top_k = 20000
        all_indices = np.argsort(-predictions[0])  # predictions[0] vì shape là (1, n)

        # Lọc các ID < 60
        filtered_indices = [int(idx) for idx in all_indices if idx < 60][:top_k]
        
        # Trả về kết quả
        return jsonify({
            'recommendations': filtered_indices[:20],
            'session_items': session_items
        })
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    # Load model và các artifacts khi khởi động server
    load_artifacts()
    print("Model and artifacts loaded successfully!")
    
    # Chạy server
    app.run(host='0.0.0.0', port=5000, debug=True)