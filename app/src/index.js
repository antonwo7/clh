import React from 'react';
import ReactDOM from 'react-dom/client';
import './assets/css/tailwind-app.css';
import 'tw-elements';
import './assets/css/app.css';
import App from './App';
import {Provider} from 'react-redux';
import {store} from './store/store';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <Provider store={store}>
        <App />
    </Provider>
);

