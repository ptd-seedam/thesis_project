import pandas as pd
import numpy as np
from tensorflow.keras.models import load_model
import os

def load_data(
        X_path='../Dataset/5-30/X_test.csv', 
        y_path='../Dataset/5-30/y_test.csv'
    ):
    X = pd.read_csv(X_path, header=None)
    y = pd.read_csv(y_path, header=None)
    X.values
    y = y.values.flatten()
    return X, y

def evaluate_model_in_batches(model, X_test, y_test, k=20, batch_size=128):
    num_samples = len(X_test)
    num_batches = int(np.ceil(num_samples / batch_size))
    
    hits = 0
    mrr = 0

    for batch_idx in range(num_batches):
        start = batch_idx * batch_size
        end = min((batch_idx + 1) * batch_size, num_samples)
        
        x_batch = X_test[start:end]
        y_batch = y_test[start:end]

        preds = model.predict(x_batch, batch_size=batch_size, verbose=0)
        top_k_preds = np.argsort(-preds, axis=1)[:, :k]

        for i, true_item in enumerate(y_batch):
            top_k = top_k_preds[i]
            if true_item in top_k:
                hits += 1
                rank = np.where(top_k == true_item)[0][0] + 1
                mrr += 1.0 / rank

    recall_at_k = hits / num_samples
    mrr_at_k = mrr / num_samples
    return recall_at_k, mrr_at_k

model = load_model('../model/5_30/session_recommendation_model_5_30.keras')

X_test, y_test = load_data()

recall20, mrr20,  = evaluate_model_in_batches(model, X_test, y_test, k=20)
print(f"Recall@20: {recall20:.4f}")
print(f"MRR@20: {mrr20:.4f}")