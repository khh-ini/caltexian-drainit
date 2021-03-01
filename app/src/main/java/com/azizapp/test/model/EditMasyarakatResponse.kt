package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class EditMasyarakatResponse(
    @SerializedName("data")
    var `data`: Data?,
    @SerializedName("message")
    var message: String?,
    @SerializedName("status_code")
    var statusCode: Int?
)