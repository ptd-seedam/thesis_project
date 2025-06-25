import { createBrowserRouter } from 'react-router-dom'
import Layout from '../components/layouts/Layout';
import Index from '../pages/Index';
import BookDetail from '../pages/BookDetail';
import BooksPageLayout from '../components/layouts/BookPageLayout';


const UserRoutes = createBrowserRouter([
    {
        path: '/login',
        element: <div>Login Page</div>
    },
    {
        path: '/register',
        element: <div>Register Page</div>
    },
    {
        path: '/',
        element: <Layout />,
        errorElement: <div>Error Page</div>,
        children: [
            {
                index: true,
                element: <Index />
            },
            {
                path: 'books',
                element: <BooksPageLayout />,
                children: [
                    {
                        index: true,
                        element: <div>List of Books</div>
                    },
                    {
                        path: ':bookId',
                        element: <BookDetail/>
                    }
                ]
            },
            {
                path: 'authors',
                element: <div>Authors Page</div>,
                children: [
                    {
                        index: true,
                    },
                    {
                        path: ':authorId',
                        element: <div>Author Details Page</div>
                    }
                ]
            },
            {
                path: 'categories',
                element: <div>Categories Page</div>,
                children: [
                    {
                        path: ':categoryId',
                        element: <div>Category Details Page</div>
                    }
                ]
            },
            {
                path: 'search',
                element: <div>Search Page</div>,
                children: [
                    {
                        path: ':query',
                        element: <div>Search Results Page</div>
                    }
                ]
            },
            {
                path: 'profile',
                element: <div>User Profile Page</div>,
                children: [
                    {
                        path: 'edit',
                        element: <div>Edit Profile Page</div>
                    }]
            },
            {
                path: 'borrowed-books',
                element: <div>Borrowed Books Page</div>,
                children: [
                    {
                        path: ':borrowedBookId',
                        element: <div>Borrowed Book Details Page</div>
                    }
                ]
            },
            {
                path: 'fines',
                element: <div>Fines Page</div>,
                children: [
                    {
                        path: ':fineId',
                        element: <div>Fine Details Page</div>
                    }
                ]
            },
        ]
    }
]);

export default UserRoutes