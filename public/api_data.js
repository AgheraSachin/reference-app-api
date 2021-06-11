define({ "api": [
  {
    "type": "post",
    "url": "/request-for-audio-video-reference",
    "title": "1. Make Request For Give Audio/Video Reference",
    "name": "1",
    "group": "Audio_Video_Reference",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Request sent successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AudioVideoReferenceController.php",
    "groupTitle": "Audio_Video_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/request-for-audio-video-reference"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/post-review",
    "title": "2. Complete Review for Audio/Video reference",
    "name": "2",
    "group": "Audio_Video_Reference",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "review_type",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>number</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "review",
            "description": "<p>file</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Review Successfully.\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AudioVideoReferenceController.php",
    "groupTitle": "Audio_Video_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/post-review"
      }
    ]
  },
  {
    "type": "get",
    "url": "/all-verified-rating/{$type}?page={page_number}&per_page={count}",
    "title": "3. Get All Verified ratings",
    "name": "3",
    "group": "Audio_Video_Reference",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": {\n\"unpublish_count\": 1,\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"from_user_id\": 1,\n\"email\": \"sachinagheara@gmail.com\",\n\"to_user_id\": 2,\n\"published\": 0,\n\"rating\": \"3\",\n\"audio\": null,\n\"video\": \"1619686360.webm\",\n\"reviwed_on\": \"2021-04-29 08:52:40\",\n\"url_token\": \"wyXjl8jghPV7lQgHr1p105skCJIj7b1GTgRpLAViRw7NngeSXBMj2AkYB6OM\",\n\"created_at\": \"2021-04-29T07:39:56.000000Z\",\n\"updated_at\": \"2021-04-29T08:52:40.000000Z\",\n\"deleted_at\": null,\n\"img\":\"https://dsdad/adad/ts.png\"\n}\n],\n\"first_page_url\": \"http://localhost:8000/api/all-verified-rating?page=1\",\n\"from\": 1,\n\"last_page\": 1,\n\"last_page_url\": \"http://localhost:8000/api/all-verified-rating?page=1\",\n\"links\": [\n{\n\"url\": null,\n\"label\": \"&laquo; Previous\",\n\"active\": false\n},\n{\n\"url\": \"http://localhost:8000/api/all-verified-rating?page=1\",\n\"label\": \"1\",\n\"active\": true\n},\n{\n\"url\": null,\n\"label\": \"Next &raquo;\",\n\"active\": false\n}\n],\n\"next_page_url\": null,\n\"path\": \"http://localhost:8000/api/all-verified-rating\",\n\"per_page\": \"10\",\n\"prev_page_url\": null,\n\"to\": 1,\n\"total\": 1\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AudioVideoReferenceController.php",
    "groupTitle": "Audio_Video_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/all-verified-rating/{$type}?page={page_number}&per_page={count}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/publish-verified-rating/{id}",
    "title": "4. Publish Given Audio/Video Reference",
    "name": "4",
    "group": "Audio_Video_Reference",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Review published Successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AudioVideoReferenceController.php",
    "groupTitle": "Audio_Video_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/publish-verified-rating/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/delete-unverified-rating/{id}",
    "title": "5. Delete reference",
    "name": "5",
    "group": "Audio_Video_Reference",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Delete Successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AudioVideoReferenceController.php",
    "groupTitle": "Audio_Video_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/delete-unverified-rating/{id}"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/accessToken",
    "title": "1. Get AccessToken",
    "name": "1",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Authorization code from linkedin</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "requested_url",
            "description": "<p>URL</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "client_id",
            "description": "<p>Client ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "client_secret",
            "description": "<p>Client Secret</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n  \"status\": true,\n  \"body\":  {\n       \"user\":{\n              \"id\": 1,\n             \"first_name\": \"Sachin\",\n             \"last_name\": \"Aghera\",\n             \"email\": \"sachinaghera4@gmail.com\",\n             \"profile_pic\": \"http://localhost/storage/Users/1617456286.jpeg\",\n             \"created_at\": \"2021-03-26T02:35:57.000000Z\",\n             \"updated_at\": \"2021-03-26T02:35:57.000000Z\",\n         },\n         \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTgzM2JhMTRjZTBhNTFjNDM3YmJkMTNjOTBkMWViNmQzYTk1MjliOWYyOWJlNzkwMjhjZGQxMDk5M2ZmMjkzMmU0N2RiZjgzYzNmMjA0NTgiLCJpYXQiOjE2MTcyMTI5MzMsIm5iZiI6MTYxNzIxMjkzMywiZXhwIjoxNjQ4NzQ4OTMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jYX8b2mj59wURFqfIGXh2Vqtf8y96oCdjDScl2ZiAjGNSrjR_lOGIMo4m4EaBKUCxNjcPvyRU4eTuqznJfsEYeqRtmQRuw3Uifp6fHUIXL6iuDEjiB6t_3f9RM2Sny-QlpV03FUW2F1KRtKKLQSjL9rMemQHefJJ4Bkz0s_rZ1YTpR35kOh9cJ8AenV5pinymKtX6wq1KVrD0aTlEQp33Rlyzk0SS40TqQsKO737VCXQY51Qd-JTJ67jWDmTPtZJKa-V14tGWRQDppx6vMMCY_KZ7eTKWy2KL-zZh_A4JfUoA4O7YalxZK33d2JKtiFLNmAUil5HjalPAcKRFIfD0EqcI8QWdUiJRkBgsliVjzClTLjoUGM2vyF767aXLwn6SDbcesYM-be5jtPsFhAbYzOu7cSdCXtuwbYquNK2QXAUq5CDR7f98TEnvz-yiL3QLgjyaTOj1_KFMhvSxLgl1mMhbJPKaAhxyp1IqCx2QCxIsE7e8BWOBWCc0TGSDsXw2lwGvxMcGF4lg-xKRNiXoH5nwXdQH7Fauxey93EdsRW5ClJcL9YvVgDP-NyXCrVVZv5T8OR1bUFcGm-UTTKo0-i-0bSyld03SrKNJYqpdaltZFbBL9vrFGZwPgt8VcarsWfQE96LhQVOtU7w_hAQsCJP31DUwg9hRi1onyNir6Q\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-400:",
          "content": "Error 422: Unprocessable Entity\n{\n  \"success\": false,\n  \"body\": \"Server Error.\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AuthController.php",
    "groupTitle": "Login",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/accessToken"
      }
    ]
  },
  {
    "type": "post",
    "url": "/signin",
    "title": "2. Signin API",
    "name": "2",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>responseCode</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n  \"status\": true,\n  \"responseCode\":200,\n    \"body\":  {\n       \"user\":{\n              \"id\": 1,\n             \"first_name\": \"Sachin\",\n             \"last_name\": \"Aghera\",\n             \"email\": \"sachinaghera4@gmail.com\",\n             \"profile_pic\": \"http://localhost/storage/Users/1617456286.jpeg\",\n             \"created_at\": \"2021-03-26T02:35:57.000000Z\",\n             \"updated_at\": \"2021-03-26T02:35:57.000000Z\",\n         },\n         \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTgzM2JhMTRjZTBhNTFjNDM3YmJkMTNjOTBkMWViNmQzYTk1MjliOWYyOWJlNzkwMjhjZGQxMDk5M2ZmMjkzMmU0N2RiZjgzYzNmMjA0NTgiLCJpYXQiOjE2MTcyMTI5MzMsIm5iZiI6MTYxNzIxMjkzMywiZXhwIjoxNjQ4NzQ4OTMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jYX8b2mj59wURFqfIGXh2Vqtf8y96oCdjDScl2ZiAjGNSrjR_lOGIMo4m4EaBKUCxNjcPvyRU4eTuqznJfsEYeqRtmQRuw3Uifp6fHUIXL6iuDEjiB6t_3f9RM2Sny-QlpV03FUW2F1KRtKKLQSjL9rMemQHefJJ4Bkz0s_rZ1YTpR35kOh9cJ8AenV5pinymKtX6wq1KVrD0aTlEQp33Rlyzk0SS40TqQsKO737VCXQY51Qd-JTJ67jWDmTPtZJKa-V14tGWRQDppx6vMMCY_KZ7eTKWy2KL-zZh_A4JfUoA4O7YalxZK33d2JKtiFLNmAUil5HjalPAcKRFIfD0EqcI8QWdUiJRkBgsliVjzClTLjoUGM2vyF767aXLwn6SDbcesYM-be5jtPsFhAbYzOu7cSdCXtuwbYquNK2QXAUq5CDR7f98TEnvz-yiL3QLgjyaTOj1_KFMhvSxLgl1mMhbJPKaAhxyp1IqCx2QCxIsE7e8BWOBWCc0TGSDsXw2lwGvxMcGF4lg-xKRNiXoH5nwXdQH7Fauxey93EdsRW5ClJcL9YvVgDP-NyXCrVVZv5T8OR1bUFcGm-UTTKo0-i-0bSyld03SrKNJYqpdaltZFbBL9vrFGZwPgt8VcarsWfQE96LhQVOtU7w_hAQsCJP31DUwg9hRi1onyNir6Q\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-500:",
          "content": "Error 500: Unprocessable Entity\n{\n  \"status\": false,\n  \"responseCode\":500,\n  \"body\": \"Server Error.\"\n},",
          "type": "json"
        },
        {
          "title": "Error-401:",
          "content": "Error 401: Unauthorized Entity\n{\n  \"status\": false,\n  \"responseCode\":401,\n  \"body\": \"Unauthorized.\"\n},",
          "type": "json"
        },
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Error\n{\n  \"status\": false,\n  \"responseCode\":503,\n  \"body\": \"error object\"\n},",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AuthController.php",
    "groupTitle": "Login",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/signin"
      }
    ]
  },
  {
    "type": "get",
    "url": "/signout",
    "title": "3. Signout User",
    "name": "3",
    "group": "Login",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"logout successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AuthController.php",
    "groupTitle": "Login",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/signout"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/change-password",
    "title": "4. Change the user's password",
    "name": "4",
    "group": "Login",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  password:'xyz',\n  password_confirmation : \"xyz\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Password Changed successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AuthController.php",
    "groupTitle": "Login",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/change-password"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/delete-account",
    "title": "5. Delete User Account",
    "name": "5",
    "group": "Login",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Delete Account Successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/AuthController.php",
    "groupTitle": "Login",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/delete-account"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/report-bug",
    "title": "1. Report Bug",
    "name": "1",
    "group": "Report_Bug",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "description",
            "description": "<p>string</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  description:'I am not able to connect',\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": \"Report Bug Successfully.\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/ReportBugController.php",
    "groupTitle": "Report_Bug",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/report-bug"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/my-conncections?page={page_number}&&per_page={per_page}",
    "title": "1. Get Login User's Connections",
    "name": "1",
    "group": "Send_Verified_Reference",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": {\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 1,\n\"to_user_id\": 2,\n\"rating\": \"3\",\n\"user\": {\n\"id\": 2,\n\"first_name\": \"Test2\",\n\"last_name\": \"Test2\",\n\"email\": \"test2@test.com\",\n\"profile_pic\": null,\n\"created_at\": \"2021-04-25T14:27:38.000000Z\",\n\"updated_at\": \"2021-04-25T14:27:38.000000Z\"\n}\n},\n{\n\"id\": 2,\n\"to_user_id\": 1,\n\"rating\": \"3\",\n\"user\": {\n\"id\": 1,\n\"first_name\": \"Test1\",\n\"last_name\": \"Test1\",\n\"email\": \"test1@test.com\",\n\"profile_pic\": null,\n\"created_at\": \"2021-04-25T14:27:38.000000Z\",\n\"updated_at\": \"2021-04-25T14:27:38.000000Z\"\n}\n}\n],\n\"first_page_url\": \"http://localhost:8000/api/my-conncections?page=1\",\n\"from\": 1,\n\"last_page\": 1,\n\"last_page_url\": \"http://localhost:8000/api/my-conncections?page=1\",\n\"links\": [\n{\n\"url\": null,\n\"label\": \"&laquo; Previous\",\n\"active\": false\n},\n{\n\"url\": \"http://localhost:8000/api/my-conncections?page=1\",\n\"label\": \"1\",\n\"active\": true\n},\n{\n\"url\": null,\n\"label\": \"Next &raquo;\",\n\"active\": false\n}\n],\n\"next_page_url\": null,\n\"path\": \"http://localhost:8000/api/my-conncections\",\n\"per_page\": \"2\",\n\"prev_page_url\": null,\n\"to\": 2,\n\"total\": 2\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/SentMyReferenceController.php",
    "groupTitle": "Send_Verified_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/my-conncections?page={page_number}&&per_page={per_page}"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/send-my-references",
    "title": "2. Send Verified Reference",
    "name": "2",
    "group": "Send_Verified_Reference",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "reference",
            "description": "<p>array</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  email:'xyz12@company.com',\n  reference[0][id] : 1,\n  reference[0][email] : 'test1@test.com',\n   reference[1][id] : 1,\n  reference[1][email] : 'test2@test.com',\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": \"Sent reference successfully.\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/SentMyReferenceController.php",
    "groupTitle": "Send_Verified_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/send-my-references"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/verify-access-code",
    "title": "3. Access Code Verify",
    "name": "3",
    "group": "Send_Verified_Reference",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "access_code",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>string</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  access_code : 35618,\n  access_token : FYEzlYKQEOR9FIto5f85OiUiUMNmgHT17aVp9Kbc8jgIB0rvLaosplHZVuti,\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": [\n{\n\"id\": 1,\n\"from_user_id\": 1,\n\"email\": \"sachinagheara@gmail.com\",\n\"to_user_id\": 2,\n\"published\": 1,\n\"rating\": \"3\",\n\"audio\": null,\n\"video\": \"http://localhost/storage/Video/1619686360.webm\",\n\"reviwed_on\": \"2021-04-29 08:52:40\",\n\"url_token\": \"wyXjl8jghPV7lQgHr1p105skCJIj7b1GTgRpLAViRw7NngeSXBMj2AkYB6OM\",\n\"created_at\": \"2021-04-29T07:39:56.000000Z\",\n\"updated_at\": \"2021-04-29T08:52:40.000000Z\",\n\"deleted_at\": null,\n\"user\": {\n\"id\": 2,\n\"first_name\": \"Test2\",\n\"last_name\": \"Test2\",\n\"email\": \"test2@test.com\",\n\"profile_pic\": null,\n\"created_at\": \"2021-04-25T14:27:38.000000Z\",\n\"updated_at\": \"2021-04-25T14:27:38.000000Z\"\n},\n\"email_to\": \"xyz12@company.com\"\n}\n]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/SentMyReferenceController.php",
    "groupTitle": "Send_Verified_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/verify-access-code"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/send-notification",
    "title": "4. Send Notification",
    "name": "4",
    "group": "Send_Verified_Reference",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "from_user_id",
            "description": "<p>number</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "to_user_id",
            "description": "<p>array</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  email:'xyz12@company.com',\n  from_user_id :1,\n  to_user_id[0]:2,\n  to_user_id[1]:3\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n \"status\": true,\n\"responseCode\": 200,\n\"body\": \"Notification send successfully\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/SentMyReferenceController.php",
    "groupTitle": "Send_Verified_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/send-notification"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/get-my-notification",
    "title": "5. Get Notifications",
    "name": "5",
    "group": "Send_Verified_Reference",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": true,\n\"responseCode\": 200,\n{\n\"status\": true,\n\"responseCode\": 200,\n\"body\": {\n\"data\": [\n{\n\"id\": 1,\n\"to_user_id\": 2,\n\"notification\": \"<b>xyz12@company.com</b> has ask you to setup a personal call with your reference <b>Test1 Test1</b>.Don't forgot to organize this call as soon as possible\",\n\"is_read\": 0,\n\"created_at\": \"2021-06-07T12:10:21.000000Z\",\n\"updated_at\": \"2021-06-07T12:10:21.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 3,\n\"to_user_id\": 2,\n\"notification\": \"<b>xyz12@company.com</b> has ask you to setup a personal call with your reference <b>Test1 Test1</b>.Don't forgot to organize this call as soon as possible\",\n\"is_read\": 0,\n\"created_at\": \"2021-06-08T05:29:24.000000Z\",\n\"updated_at\": \"2021-06-08T05:29:24.000000Z\",\n\"deleted_at\": null\n}\n],\n\"total\": 2\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/SentMyReferenceController.php",
    "groupTitle": "Send_Verified_Reference",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/get-my-notification"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/request-for-unverified-rating",
    "title": "1. Make Request For Give Rating",
    "name": "1",
    "group": "Unverified_Rating",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Request sent successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/UnverifiedRatingRequestController.php",
    "groupTitle": "Unverified_Rating",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/request-for-unverified-rating"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/request-for-unverified-rating-review",
    "title": "2. Complete Review for rating",
    "name": "2",
    "group": "Unverified_Rating",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url_token",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "full_name",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "occupation",
            "description": "<p>string</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "comment",
            "description": "<p>string</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Review Successfully.\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/UnverifiedRatingRequestController.php",
    "groupTitle": "Unverified_Rating",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/request-for-unverified-rating-review"
      }
    ]
  },
  {
    "type": "get",
    "url": "/publish-unverified-rating/{id}",
    "title": "3. Publish Given Rating",
    "name": "3",
    "group": "Unverified_Rating",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Review published Successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/UnverifiedRatingRequestController.php",
    "groupTitle": "Unverified_Rating",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/publish-unverified-rating/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/all-unverified-rating/{$type}?page={page_number}&per_page={count}",
    "title": "4. Get All Given Rating",
    "name": "4",
    "group": "Unverified_Rating",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "body",
            "description": "<p>object</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n {\n\"status\": true,\n\"responseCode\": 200,\n\"body\": {\n\"unpublish_count\": 1,\n\"current_page\": 1,\n\"data\": [\n{\n\"id\": 7,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 8,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 9,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 10,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 11,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 12,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 13,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 14,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 15,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n},\n{\n\"id\": 16,\n\"from_user_id\": 1,\n\"email\": \"tt@tt.com1\",\n\"published\": 0,\n\"reviewer_full_name\": null,\n\"reviewer_occupations\": null,\n\"rating\": null,\n\"comment\": null,\n\"last_request_on\": \"2021-04-25\",\n\"last_request_count\": \"1\",\n\"reviwed_on\": null,\n\"url_token\": \"LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL\",\n\"created_at\": \"2021-04-25T14:46:51.000000Z\",\n\"updated_at\": \"2021-04-25T14:46:51.000000Z\",\n\"deleted_at\": null\n}\n],\n\"first_page_url\": \"http://localhost:8000/api/all-unverified-rating?page=1\",\n\"from\": 1,\n\"last_page\": 2,\n\"last_page_url\": \"http://localhost:8000/api/all-unverified-rating?page=2\",\n\"links\": [\n{\n\"url\": null,\n\"label\": \"&laquo; Previous\",\n\"active\": false\n},\n{\n\"url\": \"http://localhost:8000/api/all-unverified-rating?page=1\",\n\"label\": \"1\",\n\"active\": true\n},\n{\n\"url\": \"http://localhost:8000/api/all-unverified-rating?page=2\",\n\"label\": \"2\",\n\"active\": false\n},\n{\n\"url\": \"http://localhost:8000/api/all-unverified-rating?page=2\",\n\"label\": \"Next &raquo;\",\n\"active\": false\n}\n],\n\"next_page_url\": \"http://localhost:8000/api/all-unverified-rating?page=2\",\n\"path\": \"http://localhost:8000/api/all-unverified-rating\",\n\"per_page\": \"10\",\n\"prev_page_url\": null,\n\"to\": 10,\n\"total\": 16,\n\"average\": 4.75\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-503:",
          "content": "Error 503: Validation Errors\n{\n  \"success\": false,\n  \"responseCode\": 503,\n  \"body\": \"Validation Object\"\n},",
          "type": "json"
        },
        {
          "title": "Error-500:",
          "content": "Error 500: Server Errors\n{\n  \"success\": false,\n  \"responseCode\": 500,\n  \"body\": \"Something went wrong\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>false</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/UnverifiedRatingRequestController.php",
    "groupTitle": "Unverified_Rating",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/all-unverified-rating/{$type}?page={page_number}&per_page={count}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/delete-unverified-rating/{id}",
    "title": "5. Delete reference",
    "name": "5",
    "group": "Unverified_Rating",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "responseCode",
            "description": "<p>number</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-200:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": \"Delete Successfully\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/xampp/htdocs/reference-app/app/Http/Controllers/UnverifiedRatingRequestController.php",
    "groupTitle": "Unverified_Rating",
    "sampleRequest": [
      {
        "url": "https://reference.app/api/public/api/delete-unverified-rating/{id}"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Content type</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Access Bearer token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n     \"Accept\": \"application/json\",\n     \"Authorization\": \"Bearer \".{{token}}\n}",
          "type": "json"
        }
      ]
    }
  }
] });
