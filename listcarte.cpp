#include "listcarte.h"
#include <QStandardItemModel>
#include <QSqlQuery>
#include "database.h"

ListCarte::ListCarte(COAC *parentFenetre, Database *database) :
    MyList(parentFenetre, database)
{
    this->setWindowTitle("liste des cartes");
    showList();
}

void ListCarte::showList(){

    if(db->getDB().isOpen()){

        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT Carte.Num_Carte, Carte.Etat, Etudiant.Nom, Etudiant.Prenom FROM Carte, Etudiant WHERE Carte.id_Etudiant = Etudiant.id;");
        queryPromos.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryPromos.next()) {
            qDebug() << "ListClasse::showList() > ajout d'une classe.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryPromos.value(0).toString() + " " + queryPromos.value(2).toString() + " " + queryPromos.value(3).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);
        }
        myTreeList->setModel(model);
    }

}
