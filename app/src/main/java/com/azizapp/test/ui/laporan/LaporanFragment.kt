package com.azizapp.test.ui.laporan

import android.app.Activity.RESULT_OK
import android.content.Intent
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import android.widget.Toast.LENGTH_SHORT
import androidx.databinding.DataBindingUtil
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.lifecycle.Observer
import com.azizapp.test.MainActivityNav
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentLaporanBinding
import com.azizapp.test.utill.Session
import com.google.android.material.bottomsheet.BottomSheetDialog
import com.google.android.material.snackbar.Snackbar
import dagger.hilt.android.AndroidEntryPoint
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import kotlinx.android.synthetic.main.fragment_laporan.*
import kotlinx.android.synthetic.main.fragment_laporan.view.*

@AndroidEntryPoint
class LaporanFragment : Fragment() {

    private lateinit var jenisPengaduan: String
    lateinit var binding: FragmentLaporanBinding
    private val laporanViewModel: LaporanViewModel by viewModels()

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {

        //pilihLaporan()
        binding = DataBindingUtil.inflate(inflater, R.layout.activity_login, container, false)
        //val inflater = inflater.inflate(R.layout.fragment_laporan, container, false)
        binding.apply {
            lifecycleOwner = this@LaporanFragment
            viewModelLaporan = laporanViewModel
        }
        binding.editTextNamaJalan.setOnClickListener {
            val intent = Intent(activity, LaporanActivity::class.java)
            startActivityForResult(intent, 100)
        }
        laporanViewModel.action.observe(viewLifecycleOwner, Observer { action ->
            when(action){
                LaporanViewModel.ACTION_SUCCESS -> actionSuccess()
                LaporanViewModel.ACTION_ERROR ->actionError()
                LaporanViewModel.ACTION_FAILED->actionFailed()
            }

        })
        return binding.root
    }

    private fun actionFailed() {
        Snackbar.make(binding.root,"Action Failed", Snackbar.LENGTH_SHORT).show()
    }

    private fun actionError() {
        Snackbar.make(binding.root,"Action Error",Snackbar.LENGTH_SHORT).show()
    }

    private fun actionSuccess() {
        Snackbar.make(binding.root,"Success",Snackbar.LENGTH_SHORT).show()
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {

        if (requestCode == 100 && resultCode == RESULT_OK && data != null) {
            val lat = data.getDoubleExtra("LAT", 0.0)
            val long = data.getDoubleExtra("LONG", 0.0)
            editTextNamaJalan.setText(data.getStringExtra("ADDRESS"))
            editTextLokasi.setText("[$lat,$long]")
        }
    }

    fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(requireActivity())
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener {
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Tersumbat"
        }

        view.titik_banjir.setOnClickListener {
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Banjir"
        }
    }
}