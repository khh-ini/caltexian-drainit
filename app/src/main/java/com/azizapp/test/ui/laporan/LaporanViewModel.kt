package com.azizapp.test.ui.laporan

import android.net.Uri
import android.os.Build
import androidx.annotation.RequiresApi
import java.util.Base64
import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.DataPengaduanMasyarakat
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import kotlinx.coroutines.launch
import java.io.File

class LaporanViewModel @ViewModelInject constructor(
    val repository: MainRepository
) : ViewModel() {

    companion object {
        const val ACTION_SUCCESS = "ACTION_SUCCESS"
        const val ACTION_FAILED = "ACTION_FAILED"
        const val ACTION_ERROR = "ACTION_ERROR"
    }

    val namaJalan = MutableLiveData<String>()
    val lokasi = MutableLiveData<String>()
    val deskripsi = MutableLiveData<String>()
    val tipe_pengaduan = MutableLiveData<String>()
    val loadingEnable = MutableLiveData<Boolean>()
    val img = MutableLiveData<String>()
    val action = MutableLiveData<String>()


    @RequiresApi(Build.VERSION_CODES.O)
    fun encoder(filePath: String): String{
        val bytes = File(filePath).readBytes()
        val base64 = Base64.getEncoder().encodeToString(bytes)
        return base64
    }

    @RequiresApi(Build.VERSION_CODES.O)
    fun btnLapor_Click() {

        val encode = img.value?.toString()?.let { encoder(it) }

        loadingEnable.value = true
        val bearer = "Bearer " + Session.bearer
        viewModelScope.launch {
            if (namaJalan.value.isNullOrEmpty() && lokasi.value.isNullOrEmpty() && deskripsi.value.isNullOrEmpty()) {
                loadingEnable.postValue(false)
                action.postValue(ACTION_FAILED)
            } else {

                val geometry = "{\"type\": \"Point\", \"coordinates\": ${lokasi.value}}"
                val pengaduan = DataPengaduanMasyarakat(
                    namaJalan = namaJalan.value,
                    foto = encode,
                    deskripsiPengaduan = deskripsi.value,
                    tipePengaduan = tipe_pengaduan.value?.substring(15),
                    geometry = geometry
                )
                when (val response = pengaduan.namaJalan?.let {
                    pengaduan.foto?.let { it1 ->
                        pengaduan.deskripsiPengaduan?.let { it2 ->
                            pengaduan.tipePengaduan?.let { it3 ->
                                pengaduan.geometry?.let { it4 ->
                                    repository.masyarakatLaporan(bearer,
                                        it, it1, it2, it3, it4)
                                }
                            }
                        }
                    }
                }) {
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