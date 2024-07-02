import React from 'react';
import MainForm from "../forms/MainForm";

const MainFormPage = () => {
    return (
        <section className="h-full gradient-form">
            <div className="container-fluid px-10 pb-0 h-full mx-auto mb-4">
                <div className="flex justify-center items-center flex-wrap h-full w-full g-6 text-gray-800 mx-auto">
                    <div className="block bg-white shadow-lg rounded-lg mb-4">
                        <div className="flex p-4 rounded-b dark:border-gray-600 flex-col justify-center w-full h-full">
                            <MainForm />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default MainFormPage;