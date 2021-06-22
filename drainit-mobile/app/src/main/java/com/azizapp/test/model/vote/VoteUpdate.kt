package com.azizapp.test.model.vote

import com.google.gson.annotations.SerializedName

class VoteUpdate(
    @SerializedName("_method")
    val method: String = "put",
    @SerializedName("vote")
    val vote: Boolean
)