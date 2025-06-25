export const useAuth = () => {
  const token = localStorage.getItem('authToken');
  const userStr = localStorage.getItem('user');
  const user = userStr ? JSON.parse(userStr) : null;

  return {
    isAuthenticated: !!token,
    user,
    token,
  };
};
