<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{Route('dashboard')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            
            
            @if (auth()->user()->role_display()=='Admin')
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Pasien</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{Route('pasien')}}">Data Pasien</a></li>
                        <li><a href="{{Route('pasien.add')}}">Pasien Baru</a></li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role_display()=='Admin' 
            || auth()->user()->role_display()=='Pendaftaran'
            )
            <li><a href="{{Route('rekam')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Rekam Medis</span>
                </a>
            </li>
            @elseif (auth()->user()->role_display()=='Dokter')
            <li><a href="{{Route('rekam',['tab'=>2])}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Rekam Medis</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->role_display()=='Admin' || auth()->user()->role_display()=='Apotek')
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-battery"></i>
                        <span class="nav-text">Apotek</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{Route('obat')}}">Data Obat</a></li>
                        <li><a href="{{Route('obat.resep')}}">Resep & Pemberian Obat</a></li>
                        <li><a href="{{Route('obat.riwayat')}}">Riwayat Keluar Obat</a></li>

                    </ul>
                </li>
              
            @endif
            {{-- @if (auth()->user()->role_display()=='Pendaftaran' || auth()->user()->role_display()=="Admin")
                <li><a href="{{Route('pembayaran')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-diamond"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
            @endif --}}
            @if (auth()->user()->role_display()=='Admin')
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Master Data</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{Route('tindakan')}}">Tindakan</a></li>
                    <li><a href="{{Route('petugas')}}">Petugas</a></li>
                    <li><a href="{{Route('poli')}}">Poli</a></li>
                    <li><a href="{{Route('dokter')}}">Dokter</a></li>
                    <li><a href="{{Route('icd')}}">ICD</a></li>
                </ul>
                </li>
            @endif
           
          
        </ul>
        
        <div class="copyright">
            <p><strong>Klinik Medishina</strong> © 2023 All Rights Reserved</p>
        </div>
    </div>
</div>