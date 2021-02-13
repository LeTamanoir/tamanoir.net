const html = document.documentElement
const theme = localStorage.getItem('theme');

if (theme) {
    html.classList.remove("light");
    html.classList.add(theme);
    if (theme=='dark') {
        document.getElementById("darkmode-input").checked = true;
        document.getElementsByTagName('meta')["theme-color"].content = "#050130";
    } else {
        document.getElementsByTagName('meta')["theme-color"].content = "#5762D5";
    }
}
else {
    localStorage.setItem('theme', 'light');
    html.classList.add('light');
    document.getElementsByTagName('meta')["theme-color"].content = "#050130";
}

document.querySelector("#darkmode-input").addEventListener("change", () => {
    if (document.querySelector("#darkmode-input").checked) {
        console.log(theme)
        localStorage.setItem('theme', 'dark');
        html.classList.replace("light", "dark");
        document.getElementsByTagName('meta')["theme-color"].content = "#050130";
    } else {
        html.classList.replace("dark", "light");
        localStorage.setItem('theme', 'light');
        document.getElementsByTagName('meta')["theme-color"].content = "#5762D5";
    }
})