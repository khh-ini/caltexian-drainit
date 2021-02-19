package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class Geometry(
    @SerializedName("coordinates")
    var coordinates: String?="",
    @SerializedName("type")
    var type: String? = "Point"
)