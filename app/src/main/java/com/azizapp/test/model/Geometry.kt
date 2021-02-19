package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class Geometry(
    @SerializedName("type")
    var type: String? = "Point",
    @SerializedName("coordinates")
    var coordinates: String?=""

)