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
    "url": "/all-verified-rating",
    "title": "3. Get All Verified ratings",
    "name": "2",
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
        "url": "https://reference.app/api/public/api/all-verified-rating"
      }
    ]
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
    "url": "/all-unverified-rating",
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
          "content": "HTTP/1.1 200 OK\n{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"body\": [\n                  {\n                      \"id\": 3,\n                      \"from_user_id\": 1,\n                      \"email\": \"test@test1.com\",\n                      \"published\": 1,\n                      \"reviewer_full_name\": \"Mural tel\",\n                      \"reviewer_occupations\": \"Software Engineer\",\n                      \"rating\": \"5\",\n                      \"comment\": \"He is such a great perrson\",\n                      \"last_request_on\": \"2021-04-04\",\n                      \"last_request_count\": \"1\",\n                      \"reviwed_on\": \"2021-04-04 06:46:30\",\n                      \"url_token\": \"PcXCHFp9EM60KarvJ2AfAlDxKgNFDihQUIUTWpixMcpoUQQYeOPhsnHbVX6f\",\n                      \"created_at\": \"2021-04-04T05:46:27.000000Z\",\n                      \"updated_at\": \"2021-04-04T12:02:33.000000Z\",\n                      \"deleted_at\": null\n                 }\n          ]\n }",
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
        "url": "https://reference.app/api/public/api/all-unverified-rating"
      }
    ]
  }
] });
