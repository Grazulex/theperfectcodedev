import './bootstrap';
import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '400px',
    initialEditType: 'markdown',
    previewStyle: 'vertical',
    placeholder: 'Write your code here.',
})

if (document.querySelector('#createPageForm')) {
    document.querySelector('#createPageForm').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#code').value = editor.getMarkdown();
        e.target.submit();
    });
}

if (document.querySelector('#createVersionForm')) {
    document.querySelector('#createVersionForm').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#code').value = editor.getMarkdown();
        e.target.submit();
    });
}

if (document.querySelector('#updatePageForm')) {
    editor.setMarkdown(document.querySelector('#oldCode').value);

    document.querySelector('#updatePageForm').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#code').value = editor.getMarkdown();
        e.target.submit();
    });
}

