/** @type {import('tailwindcss').Config} */
export default {
content: [
"./resources/**/*.blade.php",
"./resources/**/*.js",
"./resources/**/*.vue",

],
 darkMode: 'class',
theme: {
extend: {
colors: {
sidebar: '#f8fafc',
primary: '#1f2937',
secondary: '#6b7280'
}
},
},
plugins: [],
}
