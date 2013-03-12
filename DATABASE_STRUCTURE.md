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
 - name (string)
 - email (string)
 - login (string)
 - password (string)
 - major_role (string)

USER_PERMISSION
 - id
 - user_id (int)
 - permissions (object)

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
