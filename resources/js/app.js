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

document.querySelector('#createPageForm').addEventListener('submit', e => {
    e.preventDefault();
    document.querySelector('#code').value = editor.getMarkdown();
    e.target.submit();
});
