package com.azizapp.test.ui.laporan

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.DataPengaduanMasyarakat
import com.azizapp.test.model.Geometry
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import kotlinx.coroutines.launch

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
    val geometry = MutableLiveData<Geometry>()
    val loadingEnable = MutableLiveData<Boolean>()
    val action = MutableLiveData<String>()
    fun btnLapor_Click() {
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
                    foto = null,
                    deskripsiPengaduan = deskripsi.value,
                    geometry = geometry)
                when (val response = bearer.let { repository.masyarakatLaporan(it, pengaduan) }) {
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