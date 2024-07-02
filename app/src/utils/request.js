export function objectToFormData (data) {
    if (typeof data !== 'object') return data;

    const formData = new FormData();

    for (let key in data) {
        if (data.hasOwnProperty(key)) {
            formData.append(key, data[key])
        }
    }

    return formData
}

export function convertRequestData (files) {
    const formData = new FormData();

    for (let i = 0; i < Object.keys(files).length; i++) {
        formData.append('file_' + i, files[i])
    }

    return formData;
}
//
// export function fileListToFormData (fileList) {
//     if (typeof fileList !== 'object' || !fileList) return fileList;
//
//     const formData = new FormData()
//
//     for (let i = 0; i < Object.keys(fileList).length; i++) {
//         formData.append('file[]', i.toString())
//     }
//
//     return formData
// }