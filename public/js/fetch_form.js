document.querySelector("form").addEventListener("submit", function(e){
    e.preventDefault();

    if (this.className === 'star_form') {
        fetch(this.action, {
            method: this.method,
            body: ''
        }).then( function (result) {
            return result.json();
        }).then( function(data) {
            console.log(data);
        });
    } else {
        var news_wrapper = document.getElementsByClassName('news-wrapper')[0];
        var form_data = new FormData(this);
        var posts;

        fetch(this.action, {
            method: this.method,
            body: form_data
        }).then( function (result) {
            return result.json();
        }).then( function(data) {
            posts = data;

            news_wrapper.innerHTML = '';

            for (var i = 0; i < posts.length; i++) {
                var article = document.createElement('article');

                var article_img = document.createElement('div');
                article_img.className = 'article-img';
                var img = new Image();
                img.src = posts[i]['image'];
                img.alt = '';

                article_img.appendChild(img);

                var article_info = document.createElement('div');
                article_info.className = 'article-info';
                var h4 = document.createElement('h4');
                h4.innerHTML = posts[i]['title'];
                var p = document.createElement('p');
                p.innerHTML = posts[i]['content'].substr(0, 300);
                var a = document.createElement('a');
                a.href = '/post/'+posts[i]['id'];
                a.className = 'btn-more';
                a.innerHTML = 'More';

                article_info.appendChild(h4);
                article_info.appendChild(p);
                article_info.appendChild(a);

                article.appendChild(article_img);
                article.appendChild(article_info);


                news_wrapper.appendChild(article);
            }
        });
    }

});