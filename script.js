function submitReview() {
    var rating = document.getElementById("rating-value").innerText;
    var review = document.getElementById("review").value;
  
    if (rating && review) {
      var reviewDiv = document.createElement("div");
      reviewDiv.classList.add("review");
      reviewDiv.innerHTML = "<strong>TheUser:</strong> Rated " + rating + " <br>" + review;
      document.getElementById("reviews").appendChild(reviewDiv);
      document.getElementById("review").value = "";
    } else {
      alert("Please provide both rating and review.");
    }
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    var stars = document.querySelectorAll(".star");
  
    stars.forEach(function(star) {
      star.addEventListener("click", function() {
        var value = parseInt(star.getAttribute("data-value"));
        document.getElementById("rating-value").innerText = value + " Stars";
        stars.forEach(function(s, index) {
          if (index < value) {
            s.style.color = "#ffcc00";
          } else {
            s.style.color = "#ccc";
          }
        });
      });
    });
  });
  