// Author Maciej Makar
function loadMeal(category, nameElementId, recipeElementId) {
    fetch(`/WAD/php/Getrandommeal.php?meal_category=${encodeURIComponent(category)}`)

    .then(response => response.json())
        .then(data => {
            if (data.name) {
                document.getElementById(nameElementId).textContent = data.name;
                document.getElementById(recipeElementId).innerHTML = `<a href="${data.recipe_link}" target="_blank">View Recipe</a>`;
            } else {
                document.getElementById(nameElementId).textContent = "No meal found";
                document.getElementById(recipeElementId).textContent = "";
            }
        })
        .catch(error => console.error('Error:', error));
}

function setRandomQuote() {
    const quotes = [
        { text: "The only way to do great work is to love what you do.", author: "Steve Jobs" },
        { text: "Success is not how high you have climbed, but how you make a positive difference to the world.", author: "Roy T. Bennett" },
        { text: "Your time is limited, don’t waste it living someone else’s life.", author: "Steve Jobs" },
        { text: "Believe you can and you're halfway there.", author: "Theodore Roosevelt" },
        { text: "Do not wait to strike till the iron is hot, but make it hot by striking.", author: "William Butler Yeats" },
        { text: "The best way to predict the future is to create it.", author: "Abraham Lincoln" },
        { text: "It does not matter how slowly you go as long as you do not stop.", author: "Confucius" },
        { text: "Hardships often prepare ordinary people for an extraordinary destiny.", author: "C.S. Lewis" },
        { text: "The only limit to our realization of tomorrow is our doubts of today.", author: "Franklin D. Roosevelt" },
        { text: "Success usually comes to those who are too busy to be looking for it.", author: "Henry David Thoreau" },
        { text: "You miss 100% of the shots you don’t take.", author: "Wayne Gretzky" },
        { text: "The future belongs to those who believe in the beauty of their dreams.", author: "Eleanor Roosevelt" },
        { text: "It always seems impossible until it’s done.", author: "Nelson Mandela" },
        { text: "The only thing standing between you and your goal is the story you keep telling yourself as to why you can’t achieve it.", author: "Jordan Belfort" },
        { text: "Don’t watch the clock; do what it does. Keep going.", author: "Sam Levenson" }
    ];

    const images = [
        'Mealplanusehome/images/Quoteimgs/austin-chan-ukzHlkoz1IE-unsplash.jpg',
        'Mealplanusehome/images/Quoteimgs/ian-schneider-TamMbr4okv4-unsplash.jpg',
        'Mealplanusehome/images/Quoteimgs/patrick-tomasso-n-vxsHr9jZA-unsplash.jpg',
        'Mealplanusehome/images/Quoteimgs/stefan-cosma-0gO3-b-5m80-unsplash.jpg',
        'Mealplanusehome/images/Quoteimgs/austin-chan-ukzHlkoz1IE-unsplash.jpg',
        'Mealplanusehome/images/Quoteimgs/Troll-Face-PNG-Free-Image.png'
    ];

    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    const randomImage = images[Math.floor(Math.random() * images.length)];

    // Update the DOM with the random quote and image
    document.getElementById('quote-text').textContent = randomQuote.text;
    document.getElementById('quote-author').textContent = randomQuote.author;
    document.getElementById('quote-image').src = randomImage;
}

// Load initial meals on page load
document.addEventListener("DOMContentLoaded", function() {
    loadMeal('breakfast', 'breakfast-name', 'breakfast-recipe');
    loadMeal('lunch', 'lunch-name', 'lunch-recipe');
    loadMeal('dinner', 'dinner-name', 'dinner-recipe');
    setRandomQuote();
});
