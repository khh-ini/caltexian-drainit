package com.azizapp.test.ui.riwayat

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.DataPengaduan
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import kotlinx.coroutines.launch

class RiwayatViewModel @ViewModelInject constructor(
    public val repository: MainRepository
) : ViewModel() {

    val loadingEnable = MutableLiveData<Boolean>()
    val id_petugas = MutableLiveData<String>()
    val nama_jalan = MutableLiveData<String>()
    val tipe_pengaduan = MutableLiveData<String>()
    val deskripsi_pengaduan = MutableLiveData<String>()
    val status_pengaduan = MutableLiveData<String>()
    val laporan_petugas = MutableLiveData<String>()
    val feedback_masyarakat = MutableLiveData<String>()
    val listPengaduan: List<DataPengaduan> = mutableListOf()

    fun onLoad() {
        val bearer: String? = "Bearer " + com.azizapp.test.utill.Session.bearer
        viewModelScope.launch {
            when (val response = bearer?.let { repository.getPengaduanMasyarakat(it) }) {
                is Resource.Success -> {
                while () {
                    id_petugas.postValue(response.data?.idPetugas)
                    nama_jalan.postValue(response.data?.namaJalan)
                    tipe_pengaduan.postValue(response.data?.tipePengaduan)
                    deskripsi_pengaduan.postValue(response.data?.deskripsiPengaduan)
                    status_pengaduan.postValue(response.data?.statusPengaduan)
                    laporan_petugas.postValue(response.data?.laporanPetugas)
                    feedback_masyarakat.postValue(response.data?.feedbackMasyarakat)
                }
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                    // action.postValue(LoginViewModel.ACTION_LOGIN_ERROR)
                }
            }
        }
    }
}