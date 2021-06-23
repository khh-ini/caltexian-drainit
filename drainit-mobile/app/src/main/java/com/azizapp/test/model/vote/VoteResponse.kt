package com.azizapp.test.model.vote


import com.google.gson.annotations.SerializedName

data class VoteResponse(
    @SerializedName("data")
    val `data`: Data,
    @SerializedName("message")
    val message: String
)