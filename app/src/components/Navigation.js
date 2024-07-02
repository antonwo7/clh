import React from 'react';
import MenuIcon from "./icons/MenuIcon";
import * as classNames from "classnames";

const __TabHeaderItemLinkClass = "nav-link block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 hover:border-transparent hover:bg-gray-100 focus:border-transparent";
const __NavigationNavClass = "relative w-full flex flex-wrap items-center justify-between py-4 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 shadow-lg navbar navbar-expand-lg navbar-light";
const __NavigationButtonClass = "navbar-toggler text-gray-500 border-0 hover:shadow-none hover:no-underline py-2 px-2.5 bg-transparent focus:outline-none focus:ring-0 focus:shadow-none focus:no-underline";

const TabHeaderItem = ({ href, label, isActive = false }) => {
    return (
        <li className="nav-item">
            <a href={href}
               className={classNames(__TabHeaderItemLinkClass, {
                   'active': isActive
               })}
               data-bs-toggle="pill"
               data-bs-target={href}
               role="tab"
               aria-selected="true"
            >
                {label}
            </a>
        </li>
    )
}

const Navigation = () => {
    return (
        <nav className={__NavigationNavClass}>
            <div className="container-fluid w-full flex flex-wrap items-center justify-between px-6 relative">
                <button className={__NavigationButtonClass} type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <MenuIcon />
                </button>
                <div className="collapse navbar-collapse flex-grow items-center" id="navbarSupportedContent">
                    <ul className="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0" id="tabs-tab" role="tablist">
                        <TabHeaderItem label={'Inicio'} href={'#tabs-mainForm'} isActive={true} />
                    </ul>
                </div>
            </div>
        </nav>
    )
}

export default Navigation