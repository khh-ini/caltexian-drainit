package com.azizapp.test.ui.laporan

import android.app.Application
import android.content.ContentResolver
import android.net.Uri
import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import com.azizapp.test.utill.getFileName
import kotlinx.coroutines.launch
import okhttp3.MediaType.Companion.toMediaTypeOrNull
import okhttp3.MultipartBody
import okhttp3.RequestBody.Companion.toRequestBody
import java.io.File
import java.io.FileInputStream
import java.io.FileOutputStream

class LaporanViewModel @ViewModelInject constructor(
    val repository: MainRepository,
    val application: Application
) : ViewModel() {

    private val context by lazy {
        application.baseContext.applicationContext
    }
    private  val contentResolver by lazy {
        application.baseContext.contentResolver
    }

    companion object {
        const val ACTION_SUCCESS = "ACTION_SUCCESS"
        const val ACTION_FAILED = "ACTION_FAILED"
        const val ACTION_ERROR = "ACTION_ERROR"
    }

    val namaJalan = MutableLiveData<String>()
    val lokasi = MutableLiveData<String>()
    val img = MutableLiveData<Uri>()
    val deskripsi = MutableLiveData<String>()
    val tipe_pengaduan = MutableLiveData<String>()
    val loadingEnable = MutableLiveData<Boolean>()
    val action = MutableLiveData<String>()

    fun btnLapor_Click() {
        val parcelFileDescriptor = contentResolver.openFileDescriptor(img.value!!, "r", null)
        val file = File(context.cacheDir, contentResolver.getFileName(img.value!!))
        val inputStream = FileInputStream(parcelFileDescriptor?.fileDescriptor)
        val outputStream = FileOutputStream(file)
        inputStream.copyTo(outputStream)

        val body = UploadRequestBody(file, "image")



        loadingEnable.value = true
        val bearer = "Bearer " + Session.bearer
        viewModelScope.launch {
            if (namaJalan.value.isNullOrEmpty() && lokasi.value.isNullOrEmpty() && deskripsi.value.isNullOrEmpty()) {
                loadingEnable.postValue(false)
                action.postValue(ACTION_FAILED)
            } else {

                val geometry = "{\"type\": \"Point\", \"coordinates\": ${lokasi.value}}"
                when (repository.masyarakatLaporan(
                    bearer,
                    namaJalan.value.toString()
                        .toRequestBody("multipart/form-data".toMediaTypeOrNull()),
                    MultipartBody.Part.createFormData("foto", file.name, body),
                    tipe_pengaduan.value.toString()
                        .toRequestBody("multipart/form-data".toMediaTypeOrNull()),
                    deskripsi.value.toString()
                        .toRequestBody("multipart/form-data".toMediaTypeOrNull()),
                    geometry.toRequestBody("multipart/form-data".toMediaTypeOrNull())
                )) {
                    is Resource.Success -> {
                        loadingEnable.postValue(false)
                        action.postValue(ACTION_SUCCESS)
                    }
                    is Resource.Error -> {
                        loadingEnable.postValue(false)
                        action.postValue(ACTION_ERROR)
                    }
                }
            }
        }
    }

}