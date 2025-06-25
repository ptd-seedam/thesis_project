import NavBar from '../NavBar/NavBar'
import Footer from '../Footer/Footer'
import { Outlet } from 'react-router-dom'

function Layout() {
    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

    return (
        <div className="flex w-full h-screen overflow-hidden"
            style={{ background: '#B3D5F2' }}
        >

            <div className="flex-1 w-full flex flex-col justify-center items-center bg-gray-100">
                <NavBar />
                <main className="flex-1 w-full overflow-y-auto p-4">
                    <Outlet />
                </main>
                <Footer />
                <button
                    onClick={scrollToTop}
                    className="mt-4 px-4 py-2 bg-blue-300 hover:bg-blue-600 rounded-xl absolute bottom-4 right-4 transition-colors duration-300"
                >
                    ^
                </button>
            </div>

        </div>
    )
}

export default Layout