import axios from "axios"

class Like {
    constructor() {
      if (document.querySelector(".like-box")) {
        axios.defaults.headers.common["X-WP-Nonce"] = universityData.nonce;
        this.events();
      }
    }
  
    events() {
    //on click of the element with the class like-box
      document.querySelector(".like-box").addEventListener("click", e => this.ourClickDispatcher(e));
    }

    //methods
    ourClickDispatcher(e) {
        let currentLikeBox = e.target;
        // look for nearest element inside like box, because the user can click on the heart or the number
        while (!currentLikeBox.classList.contains("like-box")) {
          currentLikeBox = currentLikeBox.parentElement
        }

        // if current user already like the professor
        if (currentLikeBox.getAttribute("data-exists") == "yes") {
            // we interpret he wants to remove the like
            this.deleteLike(currentLikeBox);
          } else {
            // he probably wants create a like
            this.createLike(currentLikeBox);
          }
    }

    async createLike(currentLikeBox) {
      try {
        const response = await axios.post(universityData.root_url + "/wp-json/university/v1/manageLike", { "professorId":currentLikeBox.getAttribute("data-professor") });
        currentLikeBox.setAttribute("data-exists", "yes")
        var likeCount = parseInt(currentLikeBox.querySelector(".like-count").innerHTML, 10);
        likeCount++;
        currentLikeBox.querySelector(".like-count").innerHTML = likeCount;
        currentLikeBox.setAttribute("data-like", response.data);
        
        console.log(response.data);
        
      } catch (e) {
        console.log("Sorry");
        console.log(e)
      }

    }
    
    async deleteLike(currentLikeBox) {
      try {
        const response = await axios({
          url: universityData.root_url + "/wp-json/university/v1/manageLike",
          method: 'delete',
          data: { "like": currentLikeBox.getAttribute("data-like") },
        })
        currentLikeBox.setAttribute("data-exists", "no")
        var likeCount = parseInt(currentLikeBox.querySelector(".like-count").innerHTML, 10)
        likeCount--
        currentLikeBox.querySelector(".like-count").innerHTML = likeCount
        currentLikeBox.setAttribute("data-like", "")
        console.log(response.data)
      } catch (e) {
        console.log(e)
      }
    }

}

export default Like;
