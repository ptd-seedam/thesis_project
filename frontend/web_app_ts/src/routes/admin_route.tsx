import React from 'react';
import { createBrowserRouter } from 'react-router-dom';
import DashboardPage from '../pages/DashboardPage';
import AdminLayout from '../pages/layouts/AdminLayout';

const router = createBrowserRouter([
    {
      path: '/',
      element: <AdminLayout />,
      children: [
        {
          index: true,
          element: <DashboardPage />,
        },
        {
          path: 'login',
          element: <div>Login Page</div>,
        },
        {
          path: 'users',
          element: <div>Users Page</div>,
        },
        {
          path: 'users/:id',
          element: <div>User Details Page</div>,
        },
        {
          path: 'users/:id/edit',
          element: <div>Edit User Page</div>,
        },
        {
          path: 'users/create',
          element: <div>Create User Page</div>,
        },
        {
          path: 'users/:id/delete',
          element: <div>Delete User Page</div>,
        },
        {
          path: 'logout',
          element: <div>Logout Page</div>,
        },
        {
          path: 'authors',
          element: <div>Author Page</div>,
        },
        {
          path: 'authors/:id',
          element: <div>Author Details Page</div>,
        },
        {
          path: 'authors/:id/edit',
          element: <div>Edit Author Page</div>,
        },
        {
          path: 'authors/create',
          element: <div>Create Author Page</div>,
        },
        {
          path: 'authors/:id/delete',
          element: <div>Delete Author Page</div>,
        },
        {
          path: 'books',
          element: <div>Books Page</div>,
        },
        {
          path: 'books/:id',
          element: <div>Book Details Page</div>,
        },
        {
          path: 'books/:id/edit',
          element: <div>Edit Book Page</div>,
        },
        {
          path: 'books/create',
          element: <div>Create Book Page</div>,
        },
        {
          path: 'books/:id/delete',
          element: <div>Delete Book Page</div>,
        },
        {
          path: 'categories',
          element: <div>Categories Page</div>,
        },
        {
          path: 'categories/:id',
          element: <div>Category Details Page</div>,
        },
        {
          path: 'categories/:id/edit',
          element: <div>Edit Category Page</div>,
        },
        {
          path: 'categories/create',
          element: <div>Create Category Page</div>,
        },
        {
          path: 'categories/:id/delete',
          element: <div>Delete Category Page</div>,
        },
        {
          path: 'publishers',
          element: <div>Publishers Page</div>,
        },
        {
          path: 'publishers/:id',
          element: <div>Publisher Details Page</div>,
        },
        {
          path: 'publishers/:id/edit',
          element: <div>Edit Publisher Page</div>,
        },
        {
          path: 'publishers/create',
          element: <div>Create Publisher Page</div>,
        },
        {
          path: 'publishers/:id/delete',
          element: <div>Delete Publisher Page</div>,
        },
        {
          path: "browwings",
          element: <div>Borrowings Page</div>,
        },
        {
          path: "browwings/:id",
          element: <div>Borrowing Details Page</div>,
        },
        {
          path: "browwings/:id/edit",
          element: <div>Edit Borrowing Page</div>,
        },
        {
          path: "browwings/create",
          element: <div>Create Borrowing Page</div>,
        },
        {
          path: "browwings/:id/delete",
          element: <div>Delete Borrowing Page</div>,
        },
        {
          path: 'fines',
          element: <div>Fines Page</div>,
        },
        {
          path: 'fines/:id',
          element: <div>Fine Details Page</div>,
        },
        {
          path: 'fines/:id/edit',
          element: <div>Edit Fine Page</div>,
        },
        {
          path: 'fines/create',
          element: <div>Create Fine Page</div>,
        },
        {
          path: 'fines/:id/delete',
          element: <div>Delete Fine Page</div>,
        }
      ]
    }
  ])

export default router;