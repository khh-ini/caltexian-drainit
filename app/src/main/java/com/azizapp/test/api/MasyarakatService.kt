package com.azizapp.test.api

import com.azizapp.test.model.Masyarakat
import com.azizapp.test.model.MasyarakatLoginResponse
import com.azizapp.test.model.ProfileMasyarakat
import retrofit2.Response
import retrofit2.http.*

//define service class


interface MasyarakatService {

    @POST("api/login/masyarakat")
    suspend fun loginMasyarakat(
        @Body masyarakat:Masyarakat
    ):Response<MasyarakatLoginResponse>

    @GET("api/masyarakat/profile")
    suspend fun profileMasyarakat(
        @Header("Authorization") token: String
    ):Response<ProfileMasyarakat>
}