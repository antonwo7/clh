import React, {useRef, useState} from 'react';
import Input from "./elements/Input";
import Button from "./elements/Button";
import {fileAPI} from "../../services/file";
import {fileDownload, getBaseName} from "../../utils/common";
import {objectToFormData} from "../../utils/request";

const MainForm = () => {
    const [files, setFiles] = useState(null)

    const [send, {isLoading}] = fileAPI.useSendFilesActionMutation()

    const sendFiles = async (files) => {

        const response = await send({files})

        if (!response.data || !response.data.excel) return;

        const excelUrl = response.data.excel.replace("\\", '/');

        fileDownload(excelUrl)
    }

    return (
        <div className="flex flex-row">
            <div className="mr-3">
                <div className="flex rounded-md shadow-sm">
                    <input type="file" multiple={false} name="files" onChange={e => setFiles(e.target.files)} className="block w-full flex-1 rounded-none rounded-r-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 rounded-l-md" />
                </div>
            </div>
            <div className="">
                <Button type="submit" label="Enviar" loading={isLoading} onClick={() => sendFiles(files)} disabled={isLoading} />
            </div>
        </div>
    );
};

export default MainForm;