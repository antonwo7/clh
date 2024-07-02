import {createApi, fetchBaseQuery} from "@reduxjs/toolkit/query/react";
import {convertRequestData, objectToFormData} from "../utils/request";
import {fileDownload, fileDownloadToFolder} from "../utils/common";

export const fileAPI = createApi({
    reducerPath: 'files',
    baseQuery: fetchBaseQuery({
        baseUrl: `${process.env['REACT_APP_API_URL']}`,
    }),
    endpoints: (builder) => ({
        sendFilesAction: builder.mutation({
            query: (data) => ({
                url: 'send.php',
                method: 'POST',
                headers: {
                    // 'Content-Type': 'multipart/form-data'
                },
                body: convertRequestData(data.files),
                // formData: true
            }),
            async onQueryStarted(id, {dispatch, queryFulfilled}) {
                const {data, meta} = await queryFulfilled

                if (!meta?.response?.ok) {
                    alert('File sending error')
                    return;
                }

                if (!data.result) {
                    alert('Request error')
                    return;
                }

                // fileDownloadToFolder(data.word)
            }
        })
    })
})

export const {sendFilesAction} = fileAPI