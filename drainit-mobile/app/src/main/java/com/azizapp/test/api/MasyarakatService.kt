package com.azizapp.test.api

import com.azizapp.test.model.*
import com.azizapp.test.model.pengaduanvote.PengaduanWithVote
import com.azizapp.test.model.vote.Vote
import com.azizapp.test.model.vote.VoteResponse
import com.azizapp.test.model.vote.VoteUpdate
import retrofit2.Response
import retrofit2.http.*


//define service class
interface MasyarakatService {


    //Login API Call
    @POST("api/login/masyarakat")
    suspend fun loginMasyarakat(
        @Body masyarakat: Masyarakat
    ): Response<MasyarakatLoginResponse>

    //Profile API Call
    @GET("api/masyarakat/profile")
    suspend fun profileMasyarakat(
        @Header("Authorization") token: String
    ): Response<ProfileMasyarakat>

    //Register API CAll
    @POST("api/register/masyarakat")
    suspend fun daftarMasyarakat(
        @Header("Accept") accept: String,
        @Body masyarakatDaftar: MasyarakatDaftar
    ): Response<MasyarakatDaftarResponse>


    //Pengaduan API CALL
    @POST("api/pengaduan")
    suspend fun pengaduanMasyarakat(
        @Header("Authorization") token: String,
        @Header("Accept") accept: String,
        @Body dataPengaduanMasyarakat: DataPengaduanMasyarakat
    ): Response<DataPengaduanMasyarakat>


    //Pengaduan Anonymouse Call
    @POST("api/pengaduan/anonim")
    suspend fun pengaduanMasyarakatAnonim(
        @Header("Accept") accept: String,
        @Body dataPengaduanMasyarakat: DataPengaduanMasyarakat
    ): Response<DataPengaduanMasyarakat>


    //Edit Password Masyarakat Call
    @POST("api/masyarakat")
    suspend fun editPassword(
        @Header("Authorization") token: String,
        @Body editMasyarakatRequest: EditMasyarakatRequest
    ): Response<EditMasyarakatResponse>


    //Dapatkan Seluruh Pengaduan Masyarakat
    @GET("api/pengaduan_by_masyarakat")
    suspend fun riwayatMasyarakat(
        @Header("Authorization") token: String
    ): Response<PengaduanResponse>


    //GET Semua Titik Banjir
    @GET("api/titik_banjir")
    suspend fun titikBanjir(): Response<TitikBanjirResponse>


    //Get Semua Titik Tersumbat
    @GET("api/titik_tersumbat")
    suspend fun titikTersumbat(): Response<TitikTersumbatResponse>

    //Get Semua laporan
    @GET("api/pengaduan")
    suspend fun semuaLaporan(): Response<PengaduanResponse>

    //Get Semua laporan with vote
    @GET("api/pengaduanwithvote")
    suspend fun semuaLaporanVote(
        @Header("Authorization") token: String
    ): Response<PengaduanWithVote>

    @POST("api/votes")
    suspend fun firstVote(
        @Header("Authorization") token: String,
        @Body vote: Vote
    ): Response<VoteResponse>

    @POST("api/votes/{id_pengaduan}")
    suspend fun updateVote(
        @Path(value = "id_pengaduan") idPengaduan: String,
        @Header("Authorization") token: String,
        @Body voteUpdate: VoteUpdate
    ): Response<VoteResponse>
}
