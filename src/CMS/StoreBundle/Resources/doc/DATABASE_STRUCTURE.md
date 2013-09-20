###Database Structure

####POST
  - id
  - header (bloob)
  - content (bloob)
  - footer (text)
  - postType (postType entity)
  - user (user entity)
  - term (term entity)
  - created_at (datetime)
  - updated_at (datetime)

####POST_TYPE
  - id
  - name (string)
  - description (text)
  - taxonomy (taxonomy entity)
  - in_menu (boolean)
  - editable (boolean)

####USER
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
  
####TAXONOMY
  - id
  - name (string)
  - description (text)
  - postTypes (array postTypes entity)
  - terms (array terms entity)
  
####TERM
  - id
  - name (string)
  - description (text)
  - taxonomys (array taxonomys entity)
  - posts (array posts entity)
  - daddy (term entity)

####POST_ATTACHMENT
  - path (string)
  - fileName (string)
  - post_id (post entity)
