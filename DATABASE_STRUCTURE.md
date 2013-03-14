###DATABASE STRUCTURE

POST
 - id
 - header (bloob)
 - content (bloob)
 - footer (text)
 - post_type_id (int)
 - user_id (int)
 - created_at (datetime)
 - updated_at (datetime)

POST_RELASHIONSHIP
 - post_id (int)
 - daddy_id (int)

POST_TYPE
 - id
 - name (string)
 - description (text)

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

POST_TYPE_TAXONOMY_RELASHIONSHIP
 - post_type_id (int)
 - taxonomy_id (int)

TERM
 - id
 - name (string)
 - description (text)
 - taxonomy_id (int)
 - daddy_id (int)

POST_TERM_RELASHIONSHIP
 - term_id (int)
 - post_id (int)

POST_ATTACHMENT
 - post_id (int)
 - path (string)
 - label (string)
 - mime (string)
