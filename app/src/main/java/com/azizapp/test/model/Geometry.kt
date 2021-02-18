package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class Geometry(
    @SerializedName("coordinates")
    var coordinates: List<Int>?,
    @SerializedName("type")
    var type: String?
)