#ifndef ELEVELIST_H
#define ELEVELIST_H

#include "ui_elevelist.h"
#include "coac.h"
#include "database.h"

class COAC;
class Database;

class EleveList : public QDialog, private Ui::EleveList
{
    Q_OBJECT

private:
    COAC *fenetre;
    int idEleve;
    Database db;

    void showList();

public:
    explicit EleveList(COAC* fen, QWidget *parent = 0);

};

#endif // ELEVELIST_H
