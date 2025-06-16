import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const response = await api.post("/login", {
        email,
        password,
      });

      const { token, user } = response.data;

      localStorage.setItem("token", token);
      localStorage.setItem("user", JSON.stringify(user));

      navigate("/");
    // eslint-disable-next-line no-unused-vars
    } catch (err) {
      setError("Sai thông tin đăng nhập!");
    }
  };

  return (
    <div className="flex items-center justify-center h-screen bg-gray-100">
      <form onSubmit={handleLogin} className="p-6 bg-white rounded shadow w-80">
        <h2 className="mb-4 text-xl font-bold">Đăng nhập</h2>
        {error && <p className="mb-2 text-sm text-red-500">{error}</p>}
        <input
          className="w-full p-2 mb-3 border"
          type="email"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        <input
          className="w-full p-2 mb-3 border"
          type="password"
          placeholder="Mật khẩu"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        <button className="w-full py-2 text-white bg-blue-500 rounded">Đăng nhập</button>
      </form>
    </div>
  );
}
