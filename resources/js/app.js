import './bootstrap';
import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';
import {createApp} from 'vue'

import App from './App.vue'

createApp(App).mount("#app")

if (JSON.parse(localStorage.getItem('isDark'))) {
    document.documentElement.classList.add('dark')
} else {
    document.documentElement.classList.remove('dark')
}

window.themeSwitcher = function () {
    return {
        switchOn: JSON.parse(localStorage.getItem('isDark')) || false,
        switchTheme() {
            if (this.switchOn) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
            localStorage.setItem('isDark', this.switchOn)
        }
    }
}

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

