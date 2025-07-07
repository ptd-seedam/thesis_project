import pandas as pd
import numpy as np
import gc
from sklearn.preprocessing import LabelEncoder
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Embedding, LSTM, Dense, Dropout, BatchNormalization
from tensorflow.keras.optimizers import Adam
from tensorflow.keras.callbacks import EarlyStopping, ReduceLROnPlateau
import tensorflow as tf
import os

def load_data(X_path = '../Dataset/5/50/X_train.csv', y_path = '../Dataset/5/50/y_train.csv'):
    X = df = pd.read_csv(X_path, 
                     header=None)
    y = df = pd.read_csv(y_path, 
                     header=None)
    X = X.values
    y = y.values.flatten()
    return X, y

def build_model(num_items, max_len=30, embedding_dim=64):
    model = Sequential([
        Embedding(input_dim=num_items, output_dim=embedding_dim, input_length=max_len, mask_zero=True),
        LSTM(128, return_sequences=True, dropout=0.2, recurrent_dropout=0.2),
        BatchNormalization(),
        LSTM(64, dropout=0.2, recurrent_dropout=0.2),
        BatchNormalization(),
        Dense(64, activation='relu'),
        Dropout(0.2),
        Dense(num_items, activation='softmax')
    ])

    model.compile(optimizer=Adam(learning_rate=0.001), 
                  loss='sparse_categorical_crossentropy', 
                  metrics=['accuracy'])
    return model

num_items = 34481 #lấy dữ liệu từ file deital_data.txt

X, y = load_data()

model = build_model(num_items)

callbacks = [
    EarlyStopping(monitor='val_loss', patience=3, restore_best_weights=True),
    ReduceLROnPlateau(monitor='val_loss', factor=0.2, patience=2, min_lr=1e-4)
]

model.fit(X, y,
            validation_split=0.1,
            epochs=10,
            batch_size=512,
            callbacks=callbacks,
            verbose=1)

model.save('session_recommendation_model_5_30.keras')

print("Đã lưu model vào '../model/5/50/session_recommendation_model.keras'")