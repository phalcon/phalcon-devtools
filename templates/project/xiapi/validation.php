<?php

return  [
    "validation" => [
        // Phalcon default
        "Alnum" => "Field :field must contain only letters and numbers",
        "Alpha" => "Field :field must contain only letters",
        "Between" => "Field :field must be within the range of :min to :max",
        "Confirmation" => "Field :field must be the same as :with",
        "Digit" => "Field :field must be numeric",
        "Email" => "Field :field must be an email address",
        "ExclusionIn" => "Field :field must not be a part of list: :domain",
        "FileEmpty" => "Field :field must not be empty",
        "FileIniSize" => "File :field exceeds the maximum file size",
        "FileMaxResolution" => "File :field must not exceed :max resolution",
        "FileMinResolution" => "File :field must be at least :min resolution",
        "FileSize" => "File :field exceeds the size of :max",
        "FileType" => "File :field must be of type: :types",
        "FileValid" => "Field :field is not valid",
        "Identical" => "Field :field does not have the expected value",
        "InclusionIn" => "Field :field must be a part of list: :domain",
        "Numericality" => "Field :field does not have a valid numeric format",
        "PresenceOf" => "Field :field is required",
        "Regex" => "Field :field does not match the required format",
        "TooLong" => "Field :field must not exceed :max characters long",
        "TooShort" => "Field :field must be at least :min characters long",
        "Uniqueness" => "Field :field must be unique",
        "Url" => "Field :field must be a url",
        "CreditCard" => "Field :field is not valid for a credit card number",
        "Date" => "Field :field is not a valid date",

        // user defined
        "Equal" => ":field is not equal ':value'",
        "In" => ":field is not one of ':domain'",
        "Out" => ":field canot be one of ':domain'",
        "MD5" => ":field is not a md5 key",
    ]
];