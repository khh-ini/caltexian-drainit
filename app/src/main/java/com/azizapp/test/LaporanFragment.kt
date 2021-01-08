package com.azizapp.test

import android.app.Activity
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*

class LaporanFragment : Fragment() {
    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?,
                              savedInstanceState: Bundle?): View? {
        // Inflate the layout for this fragment
        val i = inflater.inflate(R.layout.fragment_laporan, container, false)
        val languages = resources.getStringArray(R.array.TipePengaduan)
        val spinner = i.findViewById<Spinner>(R.id.spinnerTipePengaduan)
        if (spinner != null) {
            val adapter = ArrayAdapter(activity!!,
                    R.layout.spinner_tipe, languages)
            spinner.adapter = adapter
            spinner.onItemSelectedListener = object :
                    AdapterView.OnItemSelectedListener {
                override fun onItemSelected(parent: AdapterView<*>,
                                            view: View, position: Int, id: Long) {
                    Toast.makeText(activity,
                            "Anda melaporkan" +
                                    "" + languages[position], Toast.LENGTH_SHORT).show()
                }

                override fun onNothingSelected(parent: AdapterView<*>) {
                    // write code to perform some action
                }
            }
        }
        return i
    }
}