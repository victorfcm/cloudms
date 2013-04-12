###DATABASE STRUCTURE

POST
   - id
   - header (bloob)
   - content (bloob)
   - footer (text)
   - postType (post-postType entity)
   - user (user entity)
   - term (term entity)
   - created_at (datetime)
   - updated_at (datetime)

POST_RELASHIONSHIP
 (UNUSED)

POST_TYPE
   - id
   - name (string)
   - description (text)
   - taxonomys (postType-taxonomy entity)
   - in_menu (boolean)

USER
   - id
   - username (string)
   - name (string)
   - email (string)
   - enabled (boolean)
   - salt (string)
   - password (string)
   - last_login (datetime)
   - locked (boolean)
   - expired (boolean)
   - expired_at (datetime)
   - confirmation_token (string)
   - password_requested_at (datetime)
   - roles (longtext)
   - credentials_expire (boolean)
   - credentials_expire_at (datetime)

USER_PERMISSION
 (UNUSED)

TAXONOMY
   - id
   - name (string)
   - description (text)
   - postTypes (postType-taxonomy entity)
   - terms (term-taxonomy entity)

POST_TYPE_TAXONOMY_RELASHIONSHIP
   - postType (postType entity)
   - taxonomy (taxonomy entity)

TERM
   - id
   - name (string)
   - description (text)
   - taxonomys (term-taxonomy entity)
   - posts (post-term entity)
   - daddy_id (int)

POST_TERM_RELASHIONSHIP
    - term (term entity)
    - post (post entity)

POST_ATTACHMENT
 (UNUSED)
