import React, { Component } from 'react';
import * as classNames from "classnames";
import MainFormPage from "./pages/MainFormPage";

const TabContentItem = ({ id, TabComponent, isActive = false }) => {
    return (
        <div
            className={classNames('tab-pane fade h-full', { 'active': isActive, 'show': isActive })}
            id={id}
            aria-labelledby="tabs-profile-tab"
        >
            <TabComponent />
        </div>
    )
}

const Content = () => {
    return (
        <div className="tab-content bg-gray-200 h-full w-full inline-table h-full" id="tabs-tabContent">
            <TabContentItem id={'tabs-mainForm'} TabComponent={MainFormPage} isActive={true} />
        </div>
    )
}

export default Content