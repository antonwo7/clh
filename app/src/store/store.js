import {configureStore} from "@reduxjs/toolkit"
import {fileAPI} from "../services/file";
import {setupListeners} from "@reduxjs/toolkit/query";

export const store = configureStore({
    reducer: {
        [fileAPI.reducerPath]: fileAPI.reducer
    },
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(fileAPI.middleware)
})

setupListeners(store.dispatch)