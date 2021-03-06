import log from './log'

let uploadController = '/cms-api/file/upload';

const form = {
    getExtension (filename) {
        let ext = /^.+\.([^.]+)$/.exec(filename);
        return ext == null ? "" : ""+ext[1].toLowerCase();
    },

    selectFile (fileSelect, options) {
        log('CMS.SelectFile');

        log('CMS.SelectFile -> adding');
            log('change');

        options.onStart();
        let files = fileSelect.files;
        let formData = new FormData();

        // Loop through each of the selected files.
        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            // Check the file type.
            // if (!file.type.match('image.*')) {
            //     continue;
            // }

            // Add the file to the request.
            formData.append('file', file, file.name);
        }

        let xhr = new XMLHttpRequest();
        (xhr.upload || xhr).addEventListener('progress', function(e) {
            let done = e.position || e.loaded;
            let total = e.totalSize || e.total;
            let p =  Math.round(done/total*100);
            // console.log('xhr progress: ' + p + '%');
            options.onProgress(p);

        });
        xhr.addEventListener('load', function(e) {
            console.log('xhr upload complete');
            console.log (e);
            let data = this.responseText;
            console.log(data);
            data = typeof data === 'object' ? data : JSON.parse(data);

            console.log(data);

            // data = {
            //    id:'',
            //    url:'',
            //    thumbnailUrl: ''
            //    name:''
            // }

            if (xhr.status === 200) {
                options.onSelect (data);
            } else {
                options.onError (data);
            }

        });
        xhr.open('post', uploadController, true);
        xhr.send(formData);
    },
};

export default form;