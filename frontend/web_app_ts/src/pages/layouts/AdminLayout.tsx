import React from "react";
import Aside from "../../components/admin/Aside/Aside";
import NavBar from "../../components/admin/NavBar/Navbar";
import { Outlet } from "react-router-dom";
import Footer from "../../components/admin/Footer";
import { SidebarProvider } from '../../context/SidebarContext';

const AdminLayout = () => {
  
  return (
     <SidebarProvider>
      {/* SidebarProvider is assumed to be imported from context/SidebarContext */}
      <div className="flex h-screen overflow-hidden">
        <Aside />
        <div className="flex-1 flex flex-col w-full">
          <NavBar />
          <Outlet />
          <Footer />
        </div>
      </div>
     </SidebarProvider>
  );
};

export default AdminLayout;
