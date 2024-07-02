export function fileDownload(url){
    const fileName = getBaseName(url)
    let link = document.createElement('a');
    link.href = url;
    link.target = '_blank';
    link.download = fileName;
    link.dispatchEvent(new MouseEvent('click'));
}

export function getBaseName(url){
    return url.substr(url.lastIndexOf("/") + 1);
}

export function asyncFunction(userFunction, timeOut = 0){
    setTimeout(userFunction, timeOut)
}

export function l(title, value){
    console.log(title, value)
}

// export function fileDownloadToFolder(fileFullName) {
//     const pickerOptions = {
//         suggestedName: getBaseName(fileFullName),
//         types: [
//             {
//                 description: 'Simple Text File',
//                 accept: {
//                     'text/plain': ['.txt'],
//                 },
//             },
//         ],
//     };
// }
