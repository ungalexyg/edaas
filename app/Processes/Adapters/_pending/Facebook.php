<?php 

/*

###############################
# Get posts data of user 
###############################

#---------------------------
# search in google fb title
#---------------------------

# trems : 
"site:facebook.com: Prismware Cutlery/Silverware Set (4 Pieces)"

# search in inner path inside domain, use "inurl"
inurl:pages/category site:www.facebook.com

# related
related:https://www.redbubble.com/



#---------------------------
# FB get user's posts id's 
#---------------------------

# path (pg = "page"): 

pg/britneyspears/posts/

# selectors :

.userContentWrapper (the post item)

form.commentable_item  (post box for cooments / likes / shares etc...)

input[type="hidden"].ft_ent_identifier [value] 

<input type="hidden" autocomplete="off" name="ft_ent_identifier" value="10156109832173234">  // << this is the post id 10156109832173234


#---------------------------
# get post's performance data
#---------------------------

# path : 
/britneyspears/posts/{post_id}
/britneyspears/posts/10156109832173234

# selectors :

a.[data-comment-prelude-ref="action_link_bling"] ._2u_j

html : 
<a href="/britneyspears/videos/10156109832173234/?comment_tracking=%7B%22tn%22%3A%22O%22%7D" 
    data-ft="{&quot;tn&quot;:&quot;O&quot;}" 
    data-comment-prelude-ref="action_link_bling" aria-label="91,885 likes 28,043 comments 15,908 shares" rel="ignore">
        <span class="_2u_j">91K Likes</span>
        <span class="_2u_j">28K Comments</span>
        <span class="_2u_j">15K Shares</span>
</a>





# other paths : 

https://www.facebook.com/look/best-microwave-egg-poacher/


*/