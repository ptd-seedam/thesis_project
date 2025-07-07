import pandas as pd
import numpy as np
import gc
from sklearn.preprocessing import LabelEncoder
import joblib
import os
from tensorflow.keras.preprocessing.sequence import pad_sequences
from sklearn.model_selection import train_test_split

def load_and_preprocess_data(file_path='../dataset/yoochoose/yoochoose-clicks.dat', sample_frac=0.25):
    df = pd.read_csv(file_path, 
                     header=None, 
                     names=['session_id', 'timestamp', 'item_id', 'category_id'],
                     dtype={'session_id': 'int32', 'timestamp': 'str', 'item_id': 'str', 'category_id': 'str'})
    
    df.sort_values(by=['session_id', 'timestamp'], inplace=True)

    # Filter sessions with at least 5 interactions
    session_lengths = df.groupby('session_id').size()
    df = df[df['session_id'].isin(session_lengths[session_lengths >= 5].index)]

    # Sample fraction of sessions
    sampled_sessions = df['session_id'].drop_duplicates().sample(frac=sample_frac, random_state=42)
    df = df[df['session_id'].isin(sampled_sessions)]

    # Encode items
    le = LabelEncoder()
    df['item_id_enc'] = le.fit_transform(df['item_id'])
    num_items = df['item_id_enc'].nunique()
    joblib.dump(le, '../Dataset/5/50/label_encoder.pkl')

    return df, num_items, le
def create_sequences(df, max_len=30, min_seq_len=5, random_state=42, test_size=0.2):
    
    sessions = df.groupby('session_id')['item_id_enc'].apply(list)

    X, y = [], []
    for session in sessions:
        for i in range(1, len(session)):
            seq = session[max(0, i - max_len):i]
            if len(seq) >= min_seq_len:
                X.append(seq)
                y.append(session[i])

    X_padded = pad_sequences(X, maxlen=max_len, padding='post')
    y_array = np.array(y)
    
    # Chia train-test
    X_train, X_test, y_train, y_test = train_test_split(
        X_padded, y_array, 
        test_size=test_size, 
        random_state=random_state,
        shuffle=True
    )
    # Đảm bảo thư mục tồn tại
    output_dir = "../Dataset/5/50/"
    os.makedirs(output_dir, exist_ok=True)

    # Ghi dữ liệu
    pd.DataFrame(X_train).to_csv(os.path.join(output_dir, 'X_train.csv'), index=False, header=False)
    pd.DataFrame(X_test).to_csv(os.path.join(output_dir, 'X_test.csv'), index=False, header=False)
    pd.DataFrame(y_train).to_csv(os.path.join(output_dir, 'y_train.csv'), index=False, header=False)
    pd.DataFrame(y_test).to_csv(os.path.join(output_dir, 'y_test.csv'), index=False, header=False)
        
    print(f"Đã lưu dữ liệu thành 4 file:")
    print(f"- X_train.csv: {X_train.shape}")
    print(f"- X_test.csv: {X_test.shape}")
    print(f"- y_train.csv: {y_train.shape}")
    print(f"- y_test.csv: {y_test.shape}")
    
    return X_train, X_test, y_train, y_test

df, num_items, label_encoder = load_and_preprocess_data()

X_train, X_test, y_train, y_test = create_sequences(
    df,
    max_len=30,
    random_state=42,
    test_size=0.2
)
print("num_items")

with open("../Dataset/5/50/detail_data.txt", "w") as f:
    f.write(f"X_train.csv: {X_train.shape}\n")
    f.write(f"X_test.csv: {X_test.shape}\n")
    f.write(f"y_train.csv: {y_train.shape}\n")
    f.write(f"y_test.csv: {y_test.shape}\n")
    f.write(f"num_items: {num_items}\n")