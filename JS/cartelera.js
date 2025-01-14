const newsData = [
    { id: 1, title: "Nueva Asamblea", date: "2024-12-09", description: "Detalles de la asamblea..." },
    { id: 2, title: "Evento Especial", date: "2024-12-10", description: "Descripción del evento..." },
];

function renderNews() {
    const container = document.getElementById("news-container");
    container.innerHTML = "";

    const searchTerm = document.getElementById("search-bar").value.toLowerCase();

    newsData
        .filter(news => news.title.toLowerCase().includes(searchTerm))
        .forEach(news => {
            const newsItem = document.createElement("div");
            newsItem.className = "news-item";
            newsItem.innerHTML = `<strong>${news.title}</strong><br><small>${news.date}</small>`;
            newsItem.onclick = () => showDetails(news.id);
            container.appendChild(newsItem);
        });
}

function showDetails(id) {
    const selectedNews = newsData.find(news => news.id === id);
    alert(`Título: ${selectedNews.title}\nDescripción: ${selectedNews.description}`);
}

document.getElementById("search-bar").oninput = renderNews;
renderNews();
