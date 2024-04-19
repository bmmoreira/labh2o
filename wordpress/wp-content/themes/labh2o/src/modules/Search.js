import $ from 'jquery';
import { __ } from '@wordpress/i18n';


class Search {
    // initiate our object
    constructor() {
        this.addSearchHTML();
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term"); // load from the DOM to save time.
        // webrowser on the on look out for the events as soon pages load(object is created)
        this.events();
        // property to the state of overlay
        this.isOverlayOpen = false;
        this.typingTimer;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.resutlsDiv = $("#search-overlay__results");
    }

    // events
    events() {
        // the on method changes the elements to match of the html so whe need the bind
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // methods
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
       setTimeout(()=> this.searchField.trigger('focus') ,301);
        console.log("our open method just run");
        this.isOverlayOpen = true;
        return false;
    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        console.log("our close method just run");
        this.isOverlayOpen = false;
    }

    keyPressDispatcher(e) {

        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }

        if(e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    typingLogic() {
        if(this.searchField.val() != this.previousValue){
            clearTimeout(this.typingTimer);
            if(this.searchField.val()){
                if(!this.isSpinnerVisible){
                    this.resutlsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resutlsDiv.html('');
                this.isSpinnerVisible = false;
            }

            
        }
       
        this.previousValue = this.searchField.val(); 
    }
        // with the arrow function we can point "this" to the GETJSON objsect instead of function(post) {} 
        //  the "this" at the end, would be pointing to the function..
        //  *note - the ".join" at the end of map is to avoid including coma(,) to each end of item 
    getResults(){
        var readmore = __( 'View All Events','university-theme');
        $.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val(),(results)=>{
            this.resutlsDiv.html(`
                <div class="row"> 
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">General Information</h2>
                        ${results.generalInfo.length ? ' <ul class="link-list min-list">' : '<p>No match</p>' } 
                        ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : `` }</li>`).join('')}
                        ${results.generalInfo.length ? '</ul>': ''}
                    </div>
                    <div class="one-third">                      
                    <h2 class="search-overlay__section-title">Programs</h2>
                        ${results.programs.length ? `<ul class="link-list min-list">` : `<p>No match. <a href="${universityData.root_url}/disciplines">View All programs</a></p>` } 
                        ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.programs.length ? '</ul>': ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Professors</h2>
                        ${results.professors.length ? ' <ul class="professors-cards">' : '<p>No match</p>' } 
                        ${results.professors.map(item => `
                            <li class="professor-card__list-item">
                                 <a class="professor-card" href="${item.permalink}"> 
                                    <img class="professor-card__image" src="${item.image}">
                                    <span class="professor-card__name">${item.title}</span>
                                </a> 
                            </li> 
                        `).join('')}
                        ${results.professors.length ? '</ul>': ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Campuses</h2>
                        ${results.campuses.length ? `<ul class="link-list min-list">` : `<p>No match. <a href="${universityData.root_url}/campuses">View All Campuses</a></p>` } 
                        ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.campuses.length ? '</ul>': ''}
                        <h2 class="search-overlay__section-title">Events</h2>
                        ${results.events.length ? `<ul class="link-list min-list">` : `<p>No match. <a href="${universityData.root_url}/campuses">View All Campuses</a></p>` } 
                        ${results.events.map(item => `
                        <div class="event-summary">
                        <a class="event-summary__date t-center" href="${item.permalink}">
                            <span class="event-summary__month">${item.month}</span>
                            <span class="event-summary__day">${item.day}</span>
                        </a>
                         <div class="event-summary__content">
                             <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                             <p>${item.description} <a href="${item.permalink}" class="nu gray">${__( 'Read more','university-theme' )}</a></p>
                         </div>
                        </div>
                        `).join('')}
                        ${results.events.length ? '</ul>': ''}
                    </div>

                </div>
            `);
            this.isSpinnerVisible = false;
        });


       /*  // when -> run assynchronous 
        $.when( 
            // normally we would need getJSON two arguments first argument is the URL
            // the second is the function you want to run that points to server response
            // however we have the 'when' that is babysitting the requests that will
            // automatically pass the results to 'then' as paramaters post and pages
            // we do not need to provide a callback function as a second argument
            $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), 
            $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
            ).then((posts, pages) => {
            // combine result post with page section
            // but inside then, there is more than the result so we need to get only the actually JSON ITEM
            // that is the 0. on post[0] and pages[0].. [1].. is fail or not
            //
            // line 101 getting a custom field authorName specified at functions php from JSON DATA
            // cheking if its a post(news) approriate to author, instead of a page website.
            var combinedResults = posts[0].concat(pages[0]);
            this.resutlsDiv.html(`
                <h2 class="search-overlay__section-title"> General Information </h2>
                ${ combinedResults.length ? ' <ul class="link-list min-list">' : '<p>No match</p>' } 
                     ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authorName}` : `` }</li>`).join('')}
                ${combinedResults.length ? '</ul>': ''}
             `);
             this.isSpinnerVisible = false;
        },()=> {
            this.resutlsDiv.html('<p>Unexpect error; please try again later</p>');
        }); */
        
    }

    addSearchHTML(){
        $("body").append(`
        <div class="search-overlay">
        <div class="seach-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
  
          </div>
        </div>
          <div class="container">
            <div id="search-overlay__results"></div>
          </div>
      </div>   
        `);
    }

}


export default Search