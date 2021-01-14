package com.azizapp.test

import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.appcompat.widget.AppCompatSpinner
import androidx.fragment.app.Fragment
import kotlinx.android.synthetic.main.fragment_laporan.*


class LaporanFragment : Fragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        val i = inflater.inflate(R.layout.fragment_laporan, container, false)
        val languages = resources.getStringArray(R.array.TipePengaduan)
        val spinner = i.findViewById<AppCompatSpinner>(R.id.spinnerTipePengaduan)
            val adapter = ArrayAdapter(
                activity!!,
                R.layout.support_simple_spinner_dropdown_item, languages
            )
            spinner.adapter = adapter
            spinner.onItemSelectedListener = object :
                    AdapterView.OnItemSelectedListener {
                override fun onItemSelected(
                    parent: AdapterView<*>,
                    view: View, position: Int, id: Long
                ) {
                    (parent.getChildAt(0) as TextView).setTextColor(Color.GRAY)
                    Toast.makeText(
                        activity,
                        "Anda melaporkan" +
                                "" + languages[position], Toast.LENGTH_SHORT
                    ).show()
                }

                override fun onNothingSelected(parent: AdapterView<*>) {
                    // write code to perform some action
                }
        //return i
            }
        return i
    }
}