@extends('layouts.dashboard')
@section('content')
    <div class="formcompte">
        <div class="title">
            <p><strong>Nouveau Compte bancaire</strong></p>
        </div>
        <form action="">
            <div class="note">
                <p><strong>remplisez le formulaire</strong></p>
            </div>
            <div class="premier">
                <select style="margin-left: 5rem;" class="select1" name="" id="nature">
                    <option value="">Nature du compte</option>
                    <option value=""> Courant</option>
                    <option value=""> Epargne</option>
                </select>
                <select style="margin-right: 5rem;" class="select2" name="" id="">
                    <option value="">type de compte</option>
                    <option value="">Client</option>
                    <option value="">Entreprise</option>
                </select>
            </div>
            <div class="deuxieme">
                <input style="margin-left: 5rem;" type="text" name="" id=""
                    placeholder="date de creation">
                <input style="margin-right: 5rem;" type="text" name="" id="" placeholder="Solde">
            </div>
            <div class="troisieme">
                <input style="margin-left: 5rem;" class="code" type="text" name="" id=""
                    placeholder="code">
                <div class="radio">
                    <label for="actif"><span style="padding-right:2.97rem">Actif :</span><input
                            style="position: relative;top: 0.2rem; border-radius: 5px;
                            outline-color: rgb(123, 216, 123);" type="radio" name="status" id="actif"
                            value="actif"></label>
                    <label for="inactif"><span style="padding-right:2.43rem; border-radius: 5px;
                        outline-color: rgb(123, 216, 123);"> Inactif :</span><input
                            style="position: relative;top: 0.1rem;" type="radio" name="status" id="inactif"
                            value="inactif"></label>
                </div>
            </div>
            <div class="envoi">
                <input type="submit" value="Creer">
            </div>
        </form>
    </div>
@endsection
