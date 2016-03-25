#include "addclasse.h"
#include <QSqlQuery>
#include <QDebug>

AddClasse::AddClasse(COAC *parentFenetre, Database *database) :
    MyAdd(parentFenetre, database)
{
    this->setWindowTitle("Ajouter une classe"
                         "");
    ledtNom = new QLineEdit;
    ledtFiliere = new QLineEdit;
    cmbEntree = new QComboBox;
    cmbSortie = new QComboBox;

    myLayout->addRow("Nom de la &classe :", ledtNom);
    myLayout->addRow("Nom de la &filière :", ledtFiliere);
    myLayout->addRow("Année d'&entrée :", cmbEntree);
    myLayout->addRow("Année de &sortie :", cmbSortie);
    setLayout(myLayout);

    connect(myButtonBox, SIGNAL(accepted()), this, SLOT(envoyer()));
}

void AddClasse::envoyer(){
    //if(db->getDB().isOpen()){
        QSqlQuery queryPromos;
        queryPromos.prepare("INSERT INTO Promo VALUES(NULL, ?, ?, ? ,?)");
        queryPromos.addBindValue(cmbEntree->currentData());
        queryPromos.addBindValue(cmbSortie->currentData());
        queryPromos.addBindValue(ledtNom->text());
        queryPromos.addBindValue(ledtFiliere->text());
        queryPromos.exec();
        qDebug() << "AddClasse::envoyer() > La classe a été ajouter.";
    //} else {
        qDebug() << "AddClasse::envoyer() > Erreur lors de l'ajout de la casse.";
    //}
}

